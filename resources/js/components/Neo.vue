<template>
  <div>
    <div class="row">
            <div class="form-group col-3">
                <label for="start date">Start Date:</label><input type="date" class="form-control" v-model="startDate">
            </div>
            <div class="form-group col-3">
                <label for="end date">End Date: </label><input type="date" class="form-control" v-model="endDate">
            </div>
            <div class="form-group col-3 pt-4">
                <input type="button" class="form-control btn btn-primary" value="Submit" @click.prevent="getData()">
            </div>
    </div>
    <canvas id="planet-chart" style="padding-top:5%;"></canvas>
  </div>
</template>

<script>
import Chart from 'chart.js'
import planetChartData from '../planet-chart'
import axios from 'axios'

export default {
  name: 'PlanetChart',
  data() {
    return {
      planetChartData: planetChartData,
      startDate: '',
      endDate: ''
    }
  },
  mounted() {
    // const ctx = document.getElementById('planet-chart');
    // new Chart(ctx, this.planetChartData);
  },
  methods:{
    getData(){
        let data = {
            start_date: this.startDate,
            end_date: this.endDate,
            detailed: true,
            api_key: 'DEMO_KEY'
        }
        axios.get('/api/getNeoFeed',{params: data}).then(res => {
            this.planetChartData = res.data;
            const ctx = document.getElementById('planet-chart');
            new Chart(ctx, this.planetChartData);
        });
    }
  }
}
</script>