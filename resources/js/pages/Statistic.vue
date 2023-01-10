<template>
    <h1>Statistic</h1>
    <div>
        <canvas id="myChart"></canvas>
    </div>
</template>

<script>

export default {
    name: "Statistic",
    data() {
        return {
            questions: [],
            results: [],
        }
    },
    mounted() {
        this.loadResults();
    },
    methods: {
        initChartJs() {
            // if (document.getElementById('myChart-js')) return; // was already loaded
            // var scriptTag = document.createElement("script");
            // scriptTag.src = "https://cdn.jsdelivr.net/npm/chart.js";
            // scriptTag.id = "myChart-js";
            // document.getElementsByTagName('head')[0].appendChild(scriptTag);

            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.questions,
                    datasets: [{
                        label: 'AVG result',
                        data: this.results,
                        borderWidth: 1
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    indexAxis: 'y'
                }
            })

            // console.log(this.questions);
            // console.log(this.results);
        },
        loadResults() {
            axios.get('/api/statistic')
                .then(res => {
                    console.log(res.data);
                    this.questions = res.data.questions;
                    this.results = res.data.results;

                    this.initChartJs();
                })
        }
    }
}

</script>

<style scoped>

</style>
