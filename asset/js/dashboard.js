

$.ajax({
    type: 'GET',
    url: './api/logs/index.php',
    success: (response) => {
        console.log(response);
        if (!response.success) return;
        response.trames.forEach(trame => {
            trame.date = new Date(trame.date * 1000)

            $('.data').append(`<p>${trame.user.mail} ${trame.protocol.name} ${formatIntDouble(trame.date.getDate()) + '/' + formatIntDouble(trame.date.getMonth()) + '/' + trame.date.getFullYear() % 100 + ' ' + formatIntDouble(trame.date.getHours()) + ':' + formatIntDouble(trame.date.getMinutes()) + ':' + formatIntDouble(trame.date.getSeconds())} ${hexToIpv4(trame.ip.from)}</p>`)
        });
    },
    error: () => {
        console.log('An error occurred');
    }
});

const formatIntDouble = (int) => {
    return (int < 10 && int >= 0) ? "0" + int : int;
}

const hexToIpv4 = (ip) => {
    ip.replace(/\r\n/g, '\n');
    var lines = ip.split('\n');

    var output = '';
    for (var i = 0; i < lines.length; i++) {
        var line = lines[i];
        var line = line.replace(/0x/gi, '');

        var match = /([0-f]+)/i.exec(line);
        if (match) {
            var matchText = parseInt(match[1], 16);
            var converted = ((matchText >> 24) & 0xff) + '.' +
                ((matchText >> 16) & 0xff) + '.' +
                ((matchText >> 8) & 0xff) + '.' +
                (matchText & 0xff);
            output += converted;
        }
        else {
            output += line;
        }
        output += '\n';
    }
    return output;
}