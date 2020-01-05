import { Component, OnInit } from '@angular/core';
import { IDropdownSettings } from 'ng-multiselect-dropdown';

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
  userRole: any;
  klanten: any;
  gereedschappen: any;
  activiteiten: any;
  /*dropdownList = [];
  selectedItems = [];
  dropdownSettings: IDropdownSettings;*/

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
    /*
    this.dropdownSettings = {
      singleSelection: true,
      idField: 'item_id',
      textField: 'item_text',
      itemsShowLimit: 3,
      enableCheckAll: false,
      maxHeight: 300,
    };*/
  }

  /*
  onItemSelect(item: any) {
    console.log(item);
  }
  onSelectAll(items: any) {
    console.log(items);
  }*/

  getMe() {
    this.wordpressService.getMe().pipe(first()).subscribe(user => {
      this.user = user;
      this.userRole = this.user;
      this.userRole = this.userRole.roles[0];

      // console.log(this.user);
      this.getGereedschappen(this.user['id']);
      this.getActiviteiten(this.user['id']);
    });
  }

  getGereedschappen(id) {
    let tmp = [];
    this.wordpressService.getGereedschappen(id).pipe(first()).subscribe(gereedschappen => {
      this.gereedschappen = gereedschappen;
      /*console.log(this.gereedschappen);

      for (let i = 0 ; i < this.gereedschappen.length; i++) {
        tmp.push({ item_id: this.gereedschappen[i].id, item_text: this.gereedschappen[i].title.rendered});
      }

      this.dropdownList = tmp;

      console.log(this.dropdownList);
      console.log(this.gereedschappen);*/
    });
  }


  getActiviteiten(id) {
    this.wordpressService.getActiviteiten(id).pipe(first()).subscribe(activiteiten => {
      this.activiteiten = activiteiten;
      // console.log(this.activiteiten);
    });
  }

  getKlanten() {
    // console.log(this.techlog);
    this.wordpressService.getKlanten()
      .pipe(first())
      .subscribe(response => {
        this.klanten = response;
        // console.log(response);
      });
  }

  createTechlog() {
    console.log(this.techlog);
    this.wordpressService.createTechlog(this.techlog)
      .pipe(first())
      .subscribe(response => {
        // console.log(response);
        this.id = response['id'];
        // console.log(this.acf);

        this.wordpressService.createTechlogAcfs(this.id, this.acf)
          .pipe(first())
          .subscribe(responseAcf => {
            // console.log(responseAcf);
            this.router.navigate(['/dashboard']);
          });
      });
  }
}
