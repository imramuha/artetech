import { Component, OnInit } from '@angular/core';

import { Router } from '@angular/router';
import { first } from 'rxjs/operators';

import { WordpressService } from '../../../services/wordpress/wordpress.service';


@Component({
  selector: 'app-activiteit-create',
  templateUrl: './activiteit-create.component.html',
  styleUrls: ['./activiteit-create.component.css']
})
export class ActiviteitCreateComponent implements OnInit {

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
    this.router.navigate(['/activiteiten']);
  }

  createActiviteit(data) {

    this.new_post.title.raw = data.title;

    this.wordpressService.createActiviteit(this.new_post)
    .pipe(first())
    .subscribe(response => {
        console.log(response);
        alert('ohayo');
        // this.router.navigate(['/activiteiten']);
    });
  }

}
