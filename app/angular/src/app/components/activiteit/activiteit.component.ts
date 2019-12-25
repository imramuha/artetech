import { Component, OnInit } from '@angular/core';


import { first } from 'rxjs/operators';

import { User } from '../../models/user';
import { WordpressService } from '../../services/wordpress/wordpress.service';


@Component({
  selector: 'app-activiteit',
  templateUrl: './activiteit.component.html',
  styleUrls: ['./activiteit.component.css']
})
export class ActiviteitComponent implements OnInit {

  user: User[] = [];
  activiteiten: any;

  constructor(private wordpressService: WordpressService) { }

  ngOnInit() {
    this.getMe();
  }


  getMe() {
    this.wordpressService.getMe().pipe(first()).subscribe(user => {
      this.user = user;
      console.log(this.user)
      this.showActiviteiten(this.user['id']);
    });
  }

  showActiviteiten(id) {
    this.wordpressService.showActiviteiten(id).pipe(first()).subscribe(activiteiten => {
      this.activiteiten = activiteiten;
      console.log(this.activiteiten);
    });
  }

  removeActiviteit(id) {
    this.wordpressService.removeActiviteit(id).pipe(first()).subscribe(response => {
      console.log(response);
      this.showActiviteiten(this.user['id']);
    });
  }

}
