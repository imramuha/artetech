import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { AuthenticationService } from '../../services/authentication/authentication.service';
import { WordpressService } from '../../services/wordpress/wordpress.service';
import { User } from '../../models/user';
import { first } from 'rxjs/operators';

@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.scss']
})
export class NavComponent implements OnInit {

  currentUser: User;
  user: User[] = [];


  constructor(
      private router: Router,
      private authenticationService: AuthenticationService,
      private wordpressService: WordpressService
  ) {
      this.authenticationService.currentUser.subscribe(x => this.currentUser = x);
  }

  ngOnInit() {
  }


  logout() {
      this.authenticationService.logout();
      this.router.navigate(['/login']);
  }

}
