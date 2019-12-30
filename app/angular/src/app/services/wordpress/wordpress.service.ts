import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

import { AuthenticationService } from '../../services/authentication/authentication.service';


import { User } from '../../models/user';


@Injectable({
  providedIn: 'root'
})
export class WordpressService {

  private baseUrl = 'http://localhost:81/wp-json/';

  private wp = this.baseUrl + 'wp/v2/';
  private acf = this.baseUrl + 'acf/v3/';

  private roles = {
    admin: 'admin',
    klant: 'klant',
    medewerker: 'medewerker',
    onderaannemer: 'onderaannemer'
  };

  user = JSON.parse(localStorage.getItem('currentUser'));


  headers = new HttpHeaders({
    'Content-Type': 'multipart/form-data'
  });

  options = { headers: this.headers };

  /*
    showUser(){
      return this._http.get(this.baseUrl + "/account/profile")
      .map(res=>res.json());
  }
  */

  constructor(
    private http: HttpClient,
    private authenticationService: AuthenticationService
  ) {

  }


  // get my user data
  getMe() {
    return this.http.get<User[]>(`${this.wp}users/me?context=edit`);
  }

  // show all gereedschaps
  getGereedschappen(id) {
    return this.http.get(`${this.wp}gereedschap?author=` + id);
  }

  getGereedschap(id) {
    return this.http.get(`${this.wp}gereedschap/` + id + `?context=edit`);
  }

  removeGereedschap(id) {
    return this.http.delete(`${this.wp}gereedschap/` + id);
  }

  updateGereedschap(id, data) {
    console.log(id, data);
    return this.http.post(`${this.wp}gereedschap/` + id, data);
  }

  createGereedschap(data) {
    return this.http.post(`${this.wp}gereedschap?status=publish`, data);
  }

  getActiviteiten(id) {
    return this.http.get(`${this.wp}activiteit?author=` + id);
  }

  getActiviteit(id) {
    return this.http.get(`${this.wp}activiteit/` + id + `?context=edit`);
  }

  removeActiviteit(id) {
    return this.http.delete(`${this.wp}activiteit/` + id);
  }

  updateActiviteit(id, data) {
    console.log(id, data);
    return this.http.post(`${this.wp}activiteit/` + id, data);
  }

  createActiviteit(data) {
    return this.http.post(`${this.wp}activiteit?status=publish`, data);
  }

  // show all gereedschaps
  getTechlogs(id) {
    return this.http.get(`${this.wp}techlog?author=` + id);
  }

  getTechlog(id) {
    return this.http.get(`${this.wp}techlog/` + id + `?context=edit`);
  }

  createTechlog(data) {
    return this.http.post(`${this.wp}techlog/`, data);
  }

  createTechlogAcfs(id, data) {
    return this.http.post(`${this.acf}techlog/` + id, data);
  }

  // get all klanten
  getKlanten() {
    return this.http.get(`${this.wp}users?roles=` + this.roles.klant);
  }



  /*
    getMe() {
      return this.http.get<User[]>(`${this.baseUrl}users/me?context=edit`);
    }
  
    updateMe(data) {
      return this.http.post(`${this.baseUrl}users/me`, data);
    }
  
    getUsers(id) {
      return this.http.get<User[]>(`${this.baseUrl}users?exclude[]=` + id + `&context=edit`);
    }
  
    getUser(id) {
      return this.http.get<User[]>(`${this.baseUrl}users/` + id + `?context=edit`);
    }
  
    follow(me, ids) {
      return this.http.post(`${this.baseUrl}users/` + me  + `?following=` + ids, null);
    }
  
    unfollow(me, ids) {
      return this.http.put(`${this.baseUrl}users/` + me  + `?following=` + ids, null);
    }
  
    showSchedule(id) {
      return this.http.get(`${this.baseUrl}schedules?author=` + id);
    }
  
    createSchedule(userId, days, wakeUpAt, data) {
      return this.http.put(`${this.baseUrl}schedules/76?days=` + wakeUpAt, data);
      // return this.http.put(`${this.baseUrl}schedules/76?days=` + days + `&wakeupat=` + wakeUpAt, data);
  
    }
  
    updateSchedule(data) {
      console.log(data);
      // return this.http.put(`${this.baseUrl}users/` + me  + `?following=` + ids, null);
    }
  
    createJournal(data) {
      return this.http.post(`${this.baseUrl}journals?status=publish`, data);
    }
  
    getUserJournals(id) {
      return this.http.get(`${this.baseUrl}journals?author=` + id);
    }
  
    removeUserJournal(id) {
      return this.http.delete(`${this.baseUrl}journals/` + id);
    }*/

}

