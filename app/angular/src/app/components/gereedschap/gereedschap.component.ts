import { Component, OnInit } from '@angular/core';


import { first } from 'rxjs/operators';

import { User } from '../../models/user';
import { WordpressService } from '../../services/wordpress/wordpress.service';


@Component({
  selector: 'app-gereedschap',
  templateUrl: './gereedschap.component.html',
  styleUrls: ['./gereedschap.component.css']
})
export class GereedschapComponent implements OnInit {

  user: User[] = [];
  gereedschappen: any;

  constructor(private wordpressService: WordpressService) { }

  ngOnInit() {
    this.getMe();
  }


  getMe() {
    this.wordpressService.getMe().pipe(first()).subscribe(user => {
      this.user = user;
      console.log(this.user)
      this.getGereedschappen(this.user['id']);
    });
  }

  getGereedschappen(id) {
    this.wordpressService.getGereedschappen(id).pipe(first()).subscribe(gereedschappen => {
      this.gereedschappen = gereedschappen;
      console.log(this.gereedschappen);
    });
  }

  removeGereedschap(id) {
    this.wordpressService.removeGereedschap(id).pipe(first()).subscribe(response => {
      console.log(response);
      this.getGereedschappen(this.user['id']);
    });
  }

}
