import { Component, OnInit } from '@angular/core';

import { Router } from '@angular/router';
import { first } from 'rxjs/operators';

import { WordpressService } from '../../../services/wordpress/wordpress.service';

@Component({
  selector: 'app-gereedschap-create',
  templateUrl: './gereedschap-create.component.html',
  styleUrls: ['./gereedschap-create.component.css']
})
export class GereedschapCreateComponent implements OnInit {

  new_post = {
    title: {
      raw: '',
    },
    status: 'publish'
  };

  constructor(
    private wordpressService: WordpressService,
    private router: Router,
  ) { }

  ngOnInit() {
  }

  goBack() {
    this.router.navigate(['/gereedschappen']);
  }

  createGereedschap(data) {

    this.new_post.title.raw = data.title;

    this.wordpressService.createGereedschap(this.new_post)
    .pipe(first())
    .subscribe(response => {
        console.log(response);
        this.router.navigate(['/gereedschappen']);
    });
  }

}
