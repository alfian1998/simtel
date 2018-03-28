<script type="text/javascript">

Highcharts.chart('combination_chart', {
    title: {
        text: 'Diagram Chart Data Pelaksanaan Kabupaten Kebumen'
    },
    xAxis: {
        categories: [<?=$list_nama_kategori?>]
    },
    credits: {
        enabled: false
    },
    labels: {
        items: [{
            html: 'Jumlah Data Pelaksanaan Dengan Chart Pie',
            style: {
                left: '10px',
                top: '0px',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
            }
        }]
    },
    series: [
    {
        type: 'column',
        name: 'Data Pelaksanaan',
        data: [<?=$get_count?>]
    },  {
        type: 'spline',
        name: 'Data Pelaksanaan',
        data: [<?=$get_count?>],
        color: Highcharts.getOptions().colors[8],
        marker: {
            lineWidth: 3,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    },  {
        type: 'pie',
        name: 'Jumlah Data',
        data: [
        <?php 
        $colors = 0;
        foreach ($list_kategori as $data): 
        ?>
        {
            name: "<?=$data['kategori_nm']?>",
            y: <?=$data['count_data']?>,
            color: Highcharts.getOptions().colors[<?=$colors?>]
        },
        <?php 
        $colors++;
        endforeach; 
        ?>
        ],
        center: [100, 50],
        size: 100,
        showInLegend: false,
        dataLabels: {
            enabled: false
        }
    }]
});


</script>