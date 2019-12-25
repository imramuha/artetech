import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ActiviteitUpdateComponent } from './activiteit-update.component';

describe('ActiviteitUpdateComponent', () => {
  let component: ActiviteitUpdateComponent;
  let fixture: ComponentFixture<ActiviteitUpdateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ActiviteitUpdateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ActiviteitUpdateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
