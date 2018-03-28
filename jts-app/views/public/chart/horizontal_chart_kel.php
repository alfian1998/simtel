<script>
Highcharts.chart('kelurahan', {
    chart: {
        type: 'bar'
    },
    title: {
        text: '<label style="font-size: 17px; font-weight: bold; font-family: Open Sans, sans-serif;">Grafik Jumlah Data</label>'
    },
    xAxis: {
        categories: [
        <?php foreach ($list_data_kecamatan as $data){ ?>
            <?php foreach ($data['list_data_kelurahan'] as $kel){ ?>
            'Kel. <?=$kel['wilayah_nm']?>',
            <?php } ?>
        <?php } ?>
        ],
        title: {
            text: null
        },
    },
    plotOptions: {
        bar: {
            marker: {
                enable: false
            }
        }
    },
    legend: {
        enabled: false
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Jumlah',
        data: [
        <?php foreach ($list_data_kecamatan as $data){ ?>
            <?php foreach ($data['list_data_kelurahan'] as $kel){ ?>
            <?=$kel['jumlah']?>,
            <?php } ?>
        <?php } ?>
        ]
    }]
});
</script>