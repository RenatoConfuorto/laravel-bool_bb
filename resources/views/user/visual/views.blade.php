@extends('layouts.dashboard')

@section('content')
  <h1>Visualizzazioni</h1>
  <div class="conteiner d-flex justify-content-left flex-wrap my-4">
    <div>
      
    <div>
      <label for="data">Seleziona anno:</label>
      <select name="data" id="data">
      <option> --</option>
      @foreach ($prova as $age)
          <option value="2022">{{ $age }}</option>
      @endforeach
      </select>
    </div>
    <div>
      <label for="data">Seleziona anno:</label>
      <select onchange="aggiora(this)" name="data" id="data">
          <option> --</option>
          <option value="2022">2022</option>
          <option value="2021">2021</option>
          <option value="2020">2020</option>
      </select>
    </div>
      <h1>2022</h1>
      <select onchange="aggiorm(this)">
          <option value="gennaio">Gennaio</option>
          <option value="febbraio">Febbraio</option>
          <option value="marzo">Marzo</option>
          <option value="aprile">Aprile</option>
          <option value="maggio">Maggio</option>
          <option value="giugno">Giugno</option>
          <option value="luglio">Luglio</option>
          <option value="agosto">Agosto</option>
          <option value="settembre">Settembre</option>
          <option value="ottobre">Ottobre</option>
          <option value="novembre">Novembre</option>
          <option value="dicembre">Dicembre</option>
        </select>
      <div>
      <canvas id="bar-chart" width="1500" height="800">
      </canvas>
      </div>
      
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@^3"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@^2"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@^1"></script>

  <!-- CHARTS -->
  <script>

      //const cData = JSON.parse( echo`<?php  $chart_data; ?>`);
      const ctx = $("#bar-chart");
      const pr = [
        {x:'32', y:3},
        {x:'11', y:3},
        {x:'2', y:3},
        {x:'1', y:3},
          ]
      const gennaio = [32,20,11,3,2,1,6,7,8];
      const febbraio = [30,20,11];
      const mese =['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];

      const data = {
        datasets: [
          {
            label: "Visualizzazioni",
            data: pr ,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
              borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
              ],
              borderWidth: 1
  }]
      };
 
 
      const chart1 = new Chart(ctx, {
        type: "bar",
        data: data,
        options: {
          plugins: {
            title: {
                display: true,
                text: 'Chart.js'
            }
        },
          labels: {
            x: {
              type: 'time',
              time: {
                unit: 'day'
              }
            },
            y: {
              beginAtZero: true
            }
          }
        },
      });

  function aggiorm(prova) {
        console.log(prova.value)
        if(prova.value === 'gennaio'){
          chart1.config.data.datasets[0].data = gennaio
        }
        if(prova.value === 'febbraio'){
          chart1.config.data.datasets[0].data = febbraio
          chart1.config.data.labels = mese 
        }
        chart1.update();
      }
      function aggiora(prova) {
        if(prova.value === '2022'){
          chart1.config.data.datasets[0].data = gennaio
          chart1.config.data.labels = mese 
        }
        if(prova.value === '2021'){
          chart1.config.data.datasets[0].data = febbraio
          chart1.config.data.labels = mese 
        }
        chart1.update();
      }
</script>
@endsection