<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kognise/water.css@latest/dist/light.min.css">
    <style>
        [v-cloak] {
            display: none;
        }
        form.inline input[type=text], form.inline button, form.inline div.vdp-datepicker {
            display:inline-flex;
        }
        form.form-category {
            background-color: #eee;
            margin-right: 6px;
            margin-bottom: 6px;
            padding: 10px;
            border: none;
            border-radius: 6px;
        }
        form.form-category label{
            padding-right: 18px;
        }
    </style>
</head>
<body>
<div class="container" id="app" v-cloak>
    <h1>グラフ表示</h1>
    <form id="category-form" class="form-category">
        <label v-for="category in categories">
        <input type="radio"
            :name="'category_'+category.id"
            :value="category.id"
            v-model="selected_category_id">
        @{{ category.name }}</label>
        </span>
    </form>

    <form id="graph-update" class="inline">
        <label for="date">日付 </label>
        <vuejs-datepicker
            :format="datepicker_format"
            :value="update_date"
            name="date"
            id="date"
            v-model="update_date"></vuejs-datepicker>
        <label for="update-val">値</label>
        <input type="text" name="update-val" id="update-val" v-model="update_val">
        <button type="button" @click="update_graph">追加</button>
    </form>
    </div>
    <canvas id="chart" width="400" height="200"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>
<script src="https://unpkg.com/vuejs-datepicker"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
const app = new Vue({
    el: '#app',
    data: {
        categories: [],
        graphs: [],
        selected_category_id: 0,
        update_date: '',
        update_val: '',
        datepicker_format: 'yyyy-MM-dd',
    },
    components: {
        vuejsDatepicker
    },
    methods: {
        set_categories: function(){
            var that = this;
            fetch('/api/category', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                that.categories = data.results;
                that.selected_category_id = 1;
            })
            .catch(error => {
                console.log(error);
                that.categories = [];
            });
        },
        set_graphs: function(){
            var that = this;
            fetch('/api/graph/all/' + this.selected_category_id, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                that.graphs = data.results;
                that.view_chart();
            })
            .catch(error => {
                console.log(error);
                that.graphs = [];
            });
        },
        view_chart: function(){
            var ctx = document.getElementById('chart').getContext('2d');
            var category_name = this.get_category_name(this.selected_category_id);
            this.chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: this.graphs.dates,
                    datasets: [{
                        label: category_name,
                        data: this.graphs.values,
                        backgroundColor: [
                            'rgba(70,130,180,0.2)'
                        ],
                        borderColor: [
                            'rgba(70,130,180,1)'
                        ],
                        borderWidth: 1
                    }]
                },
            });
        },
        get_category_name: function(id){
            var category = this.categories.find((cat) => cat.id == id);
            return category.name;
        },
        update_graph: function(id){
            var that = this;
            var data = {
                'category_id': this.selected_category_id,
                'date': moment(this.update_date).format('YYYY-MM-DD'),
                'val': this.update_val
            };
            fetch('/api/graph/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if(data.status){
                    that.set_graphs();
                }
            })
            .catch(error => {
                console.log(error);
            });
        },
    },
    watch: {
        selected_category_id: function (val, oldVal) {
            this.set_graphs();
        },
    },
    mounted() {
        const now = new Date();
        this.update_date = now;
        this.set_categories();
    },
});
</script>
</body>
</html>
