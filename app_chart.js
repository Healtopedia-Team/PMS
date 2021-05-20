function load_chart () {
  var month_cnt = []
  var months = [
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'May',
    'Jun',
    'Jul',
    'Aug',
    'Sep',
    'Oct',
    'Nov',
    'Dec'
  ]
  $.getJSON('month_app_chart.php', function (jsonObject) {
    let i = 0
    for (let x in months) {
      if (i < 12) {
        month_cnt.push(parseInt(jsonObject[x]))
      }
      i += 1
    }
    //
  })
  return month_cnt
}
//console.log(month_cnt)

var optionsProfileVisit = {
  annotations: {
    position: 'back'
  },
  dataLabels: {
    enabled: false
  },
  chart: {
    type: 'bar',
    height: 300
  },
  fill: {
    opacity: 1
  },
  plotOptions: {},
  series: [
    {
      name: 'Appointments',
      data: load_chart()
    }
  ],
  colors: '#435ebe',
  xaxis: {
    categories: [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Oct',
      'Nov',
      'Dec'
    ]
  }
}
var chartProfileVisit = new ApexCharts(
  document.querySelector('#chart-profile-visit'),
  optionsProfileVisit
)
chartProfileVisit.render()
