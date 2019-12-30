import { Component, OnInit } from '@angular/core';
import * as CanvasJS from '../../../assets/js/canvasjs.min';

import * as moment from 'moment';



import { first } from 'rxjs/operators';

import { User } from '../../models/user';
import { WordpressService } from '../../services/wordpress/wordpress.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

  user: User[] = [];
  techlogs: any;
  setDob: any;
  startuur: any;
  einduur: any;

  constructor(
    private wordpressService: WordpressService,

  ) { }

  ngOnInit() {
    this.getMe();


    // deze week
    const data = this.getCurrentWeek();
    // console.log(data);

    /*
        let dataPoints = [];
    
        function parseData() {
    
          const labels = [
            [9.15, 16.45],
            [10.00, 16.00],
            [10.00, 12.30],
            [13.20, 15.00],
            [10.15, 16.45],
            [10.00, 16.00],
            [10.00, 24.00],
          ];
    
          for (let i = 0; i < data.length; i++) {
    
            dataPoints.push({ y: labels[i], x: data[i]['_d'] });
          }
    
          console.log(dataPoints);
        }
    
        parseData();
    
        const chart = new CanvasJS.Chart("chartContainer", {
    
          theme: "light2", // "light1", "light2", "dark1", "dark2"
    
          animationEnabled: true,
    
          title: {
            text: "Prestaties deze week"
          },
          axisY: { minimum: 0, maximum: 24, interval: 1 },
          data: [{
            type: "rangeColumn",
            yValueFormatString: 'hh TT K',
            xValueFormatString: "DD/MM/YYYY",     
            toolTipContent: "{x}<br>High: {y[0]}<br>Low: {y[1]}",
            dataPoints: dataPoints
          }]
        });
    
        chart.render();*/

  }

  timeStringToFloat(time) {
    const hoursMinutes = time.split(/[.:]/);
    const hours = parseInt(hoursMinutes[0], 10);
    const minutes = hoursMinutes[1] ? parseInt(hoursMinutes[1], 10) : 0;
    return hours + minutes / 60;
  }

  timeToDecimals(data) {

    const weeks = this.getCurrentWeek();
    console.log(weeks);
    const dataPoints = [];



    for (let i = 0; i < 7; i++) {

      if (data[i]) {
        console.log(i);

        this.startuur = this.timeStringToFloat(data[i].acf.startuur);
        this.einduur = this.timeStringToFloat(data[i].acf.einduur);
      }

      console.log(this.startuur);
      console.log(this.einduur);

      dataPoints.push({
        x: weeks[i]['_d'],
        y: [this.startuur ? this.startuur : null, this.einduur ? this.einduur : null]
      });

      this.startuur = null;
      this.einduur = null;
    }

    console.log(dataPoints);
    const chart = new CanvasJS.Chart('chartContainer', {

      theme: 'light2', // "light1", "light2", "dark1", "dark2"

      animationEnabled: true,

      title: {
        text: 'Prestaties deze week'
      },
      axisY: { minimum: 0, maximum: 24, interval: 1 },
      data: [{
        type: 'rangeColumn',
        xValueFormatString: 'DD/MM/YYYY',
        toolTipContent: '{x}<br>High: {y[0]}<br>Low: {y[1]}',
        dataPoints: dataPoints
      }]
    });

    chart.render();
  }





  getCurrentWeek() {
    moment.locale('nl');
    const currentDate = moment();

    const weekStart = currentDate.clone().startOf('isoWeek');
    // console.log(weekStart);
    const weekEnd = currentDate.clone().endOf('isoWeek');

    const days = [];

    for (let i = 0; i <= 6; i++) {
      days.push(moment(weekStart).add(i, 'days'));
    }

    return days;
  }

  getMe() {
    this.wordpressService.getMe().pipe(first()).subscribe(user => {
      this.user = user;
      // console.log(this.user)
      this.getTechlogs(this.user['id']);
    });
  }

  getTechlogs(id) {
    this.wordpressService.getTechlogs(id).pipe(first()).subscribe(techlogs => {
      this.techlogs = techlogs;
      console.log(this.techlogs);

      this.timeToDecimals(this.techlogs);
    });
  }

}
