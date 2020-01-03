import { Component, OnInit } from '@angular/core';

import { Router } from '@angular/router';
import { first } from 'rxjs/operators';
import { User } from '../../models/user';

import { WordpressService } from '../../services/wordpress/wordpress.service';

@Component({
  selector: 'app-techlog',
  templateUrl: './techlog.component.html',
  styleUrls: ['./techlog.component.css']
})
export class TechlogComponent implements OnInit {

  id: any;
  user: User[] = [];
  klanten: any;
  gereedschappen: any;
  activiteiten: any;

  currentDate = new Date();

  techlog = {
    title: {
      raw: '',
    },
    status: 'publish'
  };

  acf = {
    fields: {
      klant: '',
      datum: '',
      startuur: '',
      einduur: '',
      pauze: '',
      activiteit: '',
      gereedschappen: '',
      transportkort: '',
      uurtarief: '',
    },
  };

  constructor(
    private wordpressService: WordpressService,
    private router: Router,
  ) { }

  ngOnInit() {
    this.getMe();
    this.getKlanten();
  }

  getMe() {
    this.wordpressService.getMe().pipe(first()).subscribe(user => {
      this.user = user;
      console.log(this.user);
      this.getGereedschappen(this.user['id']);
      this.getActiviteiten(this.user['id']);
    });
  }

  getGereedschappen(id) {
    this.wordpressService.getGereedschappen(id).pipe(first()).subscribe(gereedschappen => {
      this.gereedschappen = gereedschappen;
      console.log(this.gereedschappen);
    });
  }


  getActiviteiten(id) {
    this.wordpressService.getActiviteiten(id).pipe(first()).subscribe(activiteiten => {
      this.activiteiten = activiteiten;
      console.log(this.activiteiten);
    });
  }

  getKlanten() {
    console.log(this.techlog);
    this.wordpressService.getKlanten()
      .pipe(first())
      .subscribe(response => {
        this.klanten = response;
        console.log(response);
      });
  }

  createTechlog() {
    console.log(this.techlog);
    this.wordpressService.createTechlog(this.techlog)
      .pipe(first())
      .subscribe(response => {
        // console.log(response);
        this.id = response['id'];
        console.log(this.acf);

        this.wordpressService.createTechlogAcfs(this.id, this.acf)
          .pipe(first())
          .subscribe(responseAcf => {
            // console.log(responseAcf);
            this.router.navigate(['/dashboard']);
          });
      });
  }
}
