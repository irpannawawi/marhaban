<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Stok Terkini</h3>
        <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i
                    data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse"
                    class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool"
                data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button> </div>
    </div> <!-- /.card-header -->
    <div class="card-body"> <!--begin::Row-->
        <div class="row">
            <div class="col-12">
                <div id="chart">
                </div>
            </div> <!-- /.col -->
        </div> <!--end::Row-->
    </div> <!-- /.card-body -->
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
   
<script defer>
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'sales',
            data: [
                {
                    x: 'Gula',
                    y: 150
                },{
                    x: 'Terigu',
                    y: 40
                },{
                    x: 'Mentega',
                    y: 50
                }
            ]
        }],
        xaxis: {
            type: 'category'
        }
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
</script>
