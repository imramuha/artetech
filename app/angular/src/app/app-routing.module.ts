import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AuthGuard } from './guards/auth.guard';

import { LoginComponent } from './components/login/login.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';

import { GereedschapComponent } from './components/gereedschap/gereedschap.component';
import { GereedschapUpdateComponent } from './components/gereedschap/gereedschap-update/gereedschap-update.component';

import { ActiviteitComponent } from './components/activiteit/activiteit.component';
import { ActiviteitUpdateComponent } from './components/activiteit/activiteit-update/activiteit-update.component';

import { TechlogComponent } from './components/techlog/techlog.component';

const routes: Routes = [
  {
    path: 'techlog',
    component: TechlogComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'activiteiten/:id/update',
    component: ActiviteitUpdateComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'activiteiten',
    component: ActiviteitComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'gereedschappen/:id/update',
    component: GereedschapUpdateComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'gereedschappen',
    component: GereedschapComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'login',
    component: LoginComponent
  },
  {
    path: '',
    component: DashboardComponent,
    canActivate: [AuthGuard]
  },
  { path: '**', redirectTo: '' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
