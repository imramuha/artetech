import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { first } from 'rxjs/operators';

import { WordpressService } from '../../../services/wordpress/wordpress.service';


@Component({
  selector: 'app-gereedschap-update',
  templateUrl: './gereedschap-update.component.html',
  styleUrls: ['./gereedschap-update.component.css']
})
export class GereedschapUpdateComponent implements OnInit {

  gereedschap: any;
  id: any;

  constructor(
    private wordpressService: WordpressService,
    private router: Router,
    private route: ActivatedRoute,
  ) { }

  ngOnInit() {
    this.getGereedschap();
  }

  getGereedschap() {
    this.id = this.route.snapshot.params.id;

    this.wordpressService.getGereedschap(this.id).pipe(first()).subscribe(gereedschap => {
      this.gereedschap = gereedschap;
      console.log(this.gereedschap.title)
    });
  }

  goBack() {
    this.router.navigate(['/gereedschappen']);
  }

  updateGereedschap() {

    this.wordpressService.updateGereedschap(this.gereedschap.id, this.gereedschap)
    .pipe(first())
    .subscribe(response => {
      console.log(response);
      this.router.navigate(['/gereedschappen']);
    });
  }

}
