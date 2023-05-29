<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js"></script>
<script>
    var penjualanBulanan;
    var topCountryBulanan;
    $.ajax({
        url: "<?= base_url() ?>dashboard/penjualan",
        async: false,
        success: function(data) {
            penjualanBulanan = JSON.parse(data);
        }
    });

    $.ajax({
        url: "<?= base_url() ?>dashboard/topCountry",
        async: false,
        success: function(data) {
            topCountryBulanan = JSON.parse(data);
        }
    });
    console.log(topCountryBulanan);

    function dynamicSort(property) {
        return function(a, b) {
            return (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
        }
    }
    penjualanBulanan.sort(dynamicSort('y')).sort(dynamicSort('label'));
    topCountryBulanan.sort(dynamicSort('y')).sort(dynamicSort('label'));

    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    const d = new Date();

    window.onload = function() {

        var penjualan = new CanvasJS.Chart("penjualan", {
            animationEnabled: true,
            title: {
                text: "Penjualan Bulan " + monthNames[d.getMonth()]
            },
            axisY: {
                title: "Penjualan"
            },

            axisX: {
                title: "Tanggal"
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                itemclick: toggleDataSeries
            },
            data: [{
                name: "Total",
                dataPoints: penjualanBulanan
            }]
        });
        penjualan.render();

        var country = new CanvasJS.Chart("country", {
            animationEnabled: true,
            title: {
                text: "Top 10 Country"
            },
            axisY: {
                title: "Penjualan"
            },

            axisX: {
                title: "Country"
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                itemclick: toggleDataSeries
            },
            data: topCountryBulanan
        });
        country.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            e.penjualan.render();
            e.country.render();
        }

    }
</script>