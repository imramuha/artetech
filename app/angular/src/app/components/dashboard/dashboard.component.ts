import { Component, OnInit } from '@angular/core';


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

  constructor(private wordpressService: WordpressService) { }

  ngOnInit() {
    this.getMe();
  }

  getMe() {
    this.wordpressService.getMe().pipe(first()).subscribe(user => {
      this.user = user;
      console.log(this.user)
      this.getTechlogs(this.user['id']);
    });
  }

  getTechlogs(id) {
    this.wordpressService.getTechlogs(id).pipe(first()).subscribe(techlogs => {
      this.techlogs = techlogs;
      console.log(this.techlogs);
    });
  }

/*
  removeGereedschap(id) {
    this.wordpressService.removeGereedschap(id).pipe(first()).subscribe(response => {
      console.log(response);
      this.showGereedschappen(this.user['id']);
    });
  }*/

}
