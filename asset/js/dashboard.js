
// onclick sur btn connexion récupérer .val mail et password 
function getValue() {
  var input = 
  document.getElementById("mail").value;
  // Afficher la valeur
  alert(input);
}


// créer une requete ajax post qui envoie submit, mail et password au script qui gère le login (index.php)
$.ajax({
    type: 'GET',
    url: './api/logs/index.php',
    success: (response) => {
      var total_trames=16;  
      var ttl_lost=0;
        var total_ttl=0;
        var imcp = 8;
        var tcp =2;
        var tls=2;
        var udp=4;
        var good=8;
        var disable=8;

        console.log(response);
        if (!response.success) return;
        response.trames.forEach(trame => {
            trame.date = new Date(trame.date * 1000)
            
            ttl_lost=ttl_lost +(128-trame.ttl)
            total_ttl=total_ttl+128
            
            $('.data').append(`<p style="margin-top:35px">ID : ${trame.id} <br> 
            Date : 
            ${formatIntDouble(trame.date.getDate()) + '/' + 
            formatIntDouble(trame.date.getMonth()) + '/' + 
            trame.date.getFullYear() % 100 + ' ' +
             formatIntDouble(trame.date.getHours()) + ':' + 
             formatIntDouble(trame.date.getMinutes()) + ':' + 
             formatIntDouble(trame.date.getSeconds())} <br> 
            Protocole : ${trame.protocol.name} <br> 
            Protocole checksum status : ${trame.protocol.checksum.status} <br> 
            HeaderLength : ${trame.headerLength} <br> 
            HeaderChecksum : ${trame.headerChecksum} <br> 
            IP en Hexa : ${trame.ip.from} <br> 
            Adresse IP convertie : ${hexToIpv4(trame.ip.from)} <br> 
            Adresse mail: ${trame.user.mail} </p><br>`)
        });

        console.log(ttl_lost);
        console.log(total_ttl);
        
          var config = {
            type: 'pie',
            data: {
              datasets: [{
                data: [
                  total_ttl,ttl_lost
                ],
                backgroundColor: [
                  '#ba2480',
                  'Black',
                  
                ],
                label: 'total ttl'
              }],
              labels: [
                'Total',
                'Perdu',
                
              ]
            },
            options: {
              responsive: true,
              title:{
                display:true,
                text:'Graphique représentant le nombre de TTL perdus',
                fontColor:'#F5E6C7',
                fontSize:20,
              },
            }
          };
        
          
            var ctx = document.getElementById('graph1').getContext('2d');
            window.myPie = new Chart(ctx, config);

            // graph 2
            
            
            var ctx = document.getElementById('graph2').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',
            
                // The data for our dataset
                data: {
                    labels: ['Total trames', 'IMCP', 'TCP', 'TLS', 'UDP'],
                    datasets: [{
                        label: 'Nombre de trames',
                        backgroundColor: '#ba2480',
                        borderColor: 'rgb(255, 99, 132)',
                        data: [total_trames, imcp, tcp, tls, udp]
                    }]
                },
            
                // Configuration options go here
                options: {
                  title:{
                    display:true,
                    text:'Graphique représentant le nombre de trames en fonction de leur type',
                    fontColor:'#F5E6C7',
                    fontSize:20,
                  },
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero: true
                          }
                      }]
                  }
              }
            });

            var config = {
              type: 'pie',
              data: {
                datasets: [{
                  data: [
                    good,disable
                  ],
                  backgroundColor: [
                    '#ba2480',
                    'Black',
                    
                  ],
                  label: 'Checksum status',
                }],
                labels: [
                  'Good',
                  'Disable',
                  
                ]
              },
              options: {
                responsive: true,
                title:{
                  display:true,
                  text:'Graphique représentant les proportions des requêtes réussies et ayant perdues des données',
                  fontColor:'#F5E6C7',
                  fontSize:20,
                },
              }
            };
          
            
              var ctx = document.getElementById('graph3').getContext('2d');
              window.myPie = new Chart(ctx, config);
  
                
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