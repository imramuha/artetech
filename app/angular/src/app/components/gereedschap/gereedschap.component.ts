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
      this.showGereedschappen(this.user['id']);
    });
  }

  showGereedschappen(id) {
    this.wordpressService.showGereedschappen(id).pipe(first()).subscribe(gereedschappen => {
      this.gereedschappen = gereedschappen;
      console.log(this.gereedschappen);
    });
  }

  removeGereedschap(id) {
    this.wordpressService.removeGereedschap(id).pipe(first()).subscribe(response => {
      console.log(response);
      this.showGereedschappen(this.user['id']);
    });
  }

}
