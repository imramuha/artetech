import { Component, OnInit } from '@angular/core';

import { Router } from '@angular/router';
import { first } from 'rxjs/operators';

import { WordpressService } from '../../services/wordpress/wordpress.service';

@Component({
  selector: 'app-techlog',
  templateUrl: './techlog.component.html',
  styleUrls: ['./techlog.component.css']
})
export class TechlogComponent implements OnInit {

  new_post = {
    title: {
      raw: '',
    },
    status: 'publish'
  };

  acf = {
    fields: {
      afstand: '',
    },
  }

  constructor(
    private wordpressService: WordpressService,
    private router: Router,
  ) { }

  ngOnInit() {
  }

  createTechlog() {

    console.log(this.acf);

    this.wordpressService.createTechlog(this.acf)
      .pipe(first())
      .subscribe(response => {
        console.log(response);
        // this.router.navigate(['/dashboard']);
      });
  }

}
