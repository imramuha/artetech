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

  totaalUrenWeek: any;
  totaalUrenMaand: any;
  totaalUrenJaar: any;

  totaalUrenZaterdagWeek: any;

  totaalUrenZondagWeek: any;

  totaalOverUrenWeek: any;

  constructor(
    private wordpressService: WordpressService,

  ) { }

  ngOnInit() {
    this.getMe();

    // deze week
    const data = this.getCurrentWeek();
  }

  timeStringToFloat(time) {
    const hoursMinutes = time.split(/[.:]/);
    const hours = parseInt(hoursMinutes[0], 10);
    const minutes = hoursMinutes[1] ? parseInt(hoursMinutes[1], 10) : 0;
    return hours + minutes / 60;
  }

  timeToDecimals(data) {

    const weeks = this.getCurrentWeek();
    const dataPoints = [];

    for (let i = 0; i < 7; i++) {

      if (data[i]) {
        console.log(i);

        this.startuur = this.timeStringToFloat(data[i].acf.startuur);
        this.einduur = this.timeStringToFloat(data[i].acf.einduur);
      }

      dataPoints.push({
        x: weeks[i]['_d'],
        y: [this.startuur ? this.startuur : null, this.einduur ? this.einduur : null]
      });

      this.startuur = null;
      this.einduur = null;
    }

    console.log(dataPoints);
    this.getTotaalUren(dataPoints);
    // this.getDayWeek(dataPoints);
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
        toolTipContent: '{x}<br>Start: {y[0]}<br>Einde: {y[1]}',
        dataPoints: dataPoints
      }]
    });

    chart.render();
  }

  // tel de totaaluren op/week
  getTotaalUren(data) {
    // console.log(data);
    let getal = 0;
    let overUren = 0;
    let zaterdag = 0;
    let zondag = 0;

    for (let i = 0; i < 7; i++) {

      if (data[i]) {
        getal = getal + Math.abs(data[i].y[1] - data[i].y[0]);

        overUren = overUren + Math.max(0, data[i].y[1] - data[i].y[0] - 8);
      }

      if (i === 5 ) {
        zaterdag = zaterdag+ Math.abs(data[i].y[1] - data[i].y[0]);
      }
      if (i === 6 ) {
        zondag = zondag + Math.abs(data[i].y[1] - data[i].y[0]);
      }

    }

    this.totaalUrenWeek = getal;
    this.getWeekendDays(zaterdag, zondag);
    this.getOverUren(overUren);
  }

  // tel de overuren op
  getOverUren(data) {
    this.totaalOverUrenWeek = data;
  }


  // haal de data voor de huidige week op
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

  // haal de uren voor zater/zondag op
  getWeekendDays(zaterdag, zondag) {
    this.totaalUrenZaterdagWeek = zaterdag;
    this.totaalUrenZondagWeek = zondag;
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
      // console.log(this.techlogs);

      this.timeToDecimals(this.techlogs);
    });
  }

}
