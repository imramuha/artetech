import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule  } from '@angular/forms';

import { registerLocaleData } from '@angular/common';
import localeNlBE from '@angular/common/locales/nl-BE';

import { HttpClientModule, HttpClient, HTTP_INTERCEPTORS  } from '@angular/common/http';

import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';


import { NgMultiSelectDropDownModule } from 'ng-multiselect-dropdown';
import { AppRoutingModule } from './app-routing.module';
import { RouterModule } from '@angular/router';
import { AppComponent } from './app.component';

import { DashboardComponent } from './components/dashboard/dashboard.component';
import { LoginComponent } from './components/login/login.component';
import { NavComponent } from './components/nav/nav.component';
import { FooterComponent } from './components/footer/footer.component';

import { GereedschapComponent } from './components/gereedschap/gereedschap.component';

import { JwtInterceptor } from './helpers/jwt.interceptor';
import { ErrorInterceptor } from './helpers/error.interceptor';
import { ActiviteitComponent } from './components/activiteit/activiteit.component';
import { TechlogComponent } from './components/techlog/techlog.component';
import { GereedschapUpdateComponent } from './components/gereedschap/gereedschap-update/gereedschap-update.component';
import { ActiviteitUpdateComponent } from './components/activiteit/activiteit-update/activiteit-update.component';
import { ActiviteitCreateComponent } from './components/activiteit/activiteit-create/activiteit-create.component';
import { GereedschapCreateComponent } from './components/gereedschap/gereedschap-create/gereedschap-create.component';

// registerig the locale of this app
registerLocaleData(localeNlBE);

// import entire icon styles.
library.add(fas, far);

@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,
    GereedschapComponent,
    FooterComponent,
    LoginComponent,
    NavComponent,
    ActiviteitComponent,
    TechlogComponent,
    GereedschapUpdateComponent,
    ActiviteitUpdateComponent,
    ActiviteitCreateComponent,
    GereedschapCreateComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    RouterModule,
    FontAwesomeModule,
    ReactiveFormsModule,
    HttpClientModule,
    NgMultiSelectDropDownModule.forRoot()
  ],
  providers: [
    { provide: HTTP_INTERCEPTORS, useClass: JwtInterceptor, multi: true },
    { provide: HTTP_INTERCEPTORS, useClass: ErrorInterceptor, multi: true },
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
