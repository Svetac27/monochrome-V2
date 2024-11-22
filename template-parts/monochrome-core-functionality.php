
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <div class="box dark rounded-20px text-white overflow-hidden hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="charts relative">
                    <div class="relative chart-wrapper">
                        <div class="chart-item absolute top-0 left-0 w-full">
                            <canvas id="myChart1"></canvas>
                        </div>
                    </div>
                    <div class="relative chart-wrapper">
                        <div class="chart-item absolute bottom-0 left-0 w-full">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>
                <div class="info">
                    <h2>More Than Capable</h2>
                    <p class="opacity-80">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>

                    <a class="mt-10px"><i class="icon-download p-0"></i> DOWNLOAD CAPABILITY MAP <span>(PDF 1.2MB)</span></a>
                </div>
            </div>
        </div>

        <style>
            .charts {
                height: 692px;                
            }
            .charts .chart-wrapper {
                overflow: hidden;
                height: calc(692px / 2);
            }
            .charts .chart-item {
/*                transform: rotate(-90deg);*/
            }
        </style>