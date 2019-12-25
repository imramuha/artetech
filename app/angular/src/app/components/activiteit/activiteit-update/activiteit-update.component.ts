import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { first } from 'rxjs/operators';

import { WordpressService } from '../../../services/wordpress/wordpress.service';

@Component({
  selector: 'app-activiteit-update',
  templateUrl: './activiteit-update.component.html',
  styleUrls: ['./activiteit-update.component.css']
})
export class ActiviteitUpdateComponent implements OnInit {

  activiteit: any;
  id: any;

  constructor(
    private wordpressService: WordpressService,
    private router: Router,
    private route: ActivatedRoute,
  ) { }

  ngOnInit() {
    this.getActiviteit();
  }

  getActiviteit() {
    this.id = this.route.snapshot.params.id;

    this.wordpressService.getActiviteit(this.id).pipe(first()).subscribe(activiteit => {
      this.activiteit = activiteit;
      console.log(this.activiteit.title);
    });
  }

  goBack() {
    this.router.navigate(['/activiteiten']);
  }

  updateActiviteit() {

    this.wordpressService.updateActiviteit(this.activiteit.id, this.activiteit)
    .pipe(first())
    .subscribe(response => {
      console.log(response);
      this.router.navigate(['/activiteiten']);
    });
  }

}
