<div>
    <div x-show="tab == '#tab1'" class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="total-opens-chart" style="height: 400px;"></div>
        <script>
            const totalOpensChart = new Chartisan({
                el: '#total-opens-chart',
                url: "@chart('total_opens_chart')",
                hooks: new ChartisanHooks()
                    .legend({ position: 'bottom' })
                    .title('Total Opens')
                    .datasets([{type: 'line', fill: true }])
                    .tooltip()
                    .legend(false)
            });
        </script>
    </div>
    <div x-show="tab == '#tab2'" class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="brand-opens-chart" style="height: 600px;"></div>
        <script>
            const brandOpensChart = new Chartisan({
                el: '#brand-opens-chart',
                url: "@chart('brand_opens_chart')",
                hooks: new ChartisanHooks()
                    .legend({ position: 'bottom' })
                    .title('Brand Opens')
                    .datasets([{type: 'line', fill: true }])
                    .tooltip()
                    .legend(false)
            });
        </script>
    </div>
    <div x-show="tab == '#tab3'" class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="contact-list-opens-chart" style="height: 800px;"></div>
        <script>
            const contactListOpensChart = new Chartisan({
                el: '#contact-list-opens-chart',
                url: "@chart('contact_list_opens_chart')",
                hooks: new ChartisanHooks()
                    .legend({ position: 'bottom' })
                    .title('Contact List Opens')
                    .datasets([{type: 'line', fill: true }])
                    .tooltip()
                    .legend(false)
            });
        </script>
    </div>
</div>
