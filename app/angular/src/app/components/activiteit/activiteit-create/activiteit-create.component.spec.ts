import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ActiviteitCreateComponent } from './activiteit-create.component';

describe('ActiviteitCreateComponent', () => {
  let component: ActiviteitCreateComponent;
  let fixture: ComponentFixture<ActiviteitCreateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ActiviteitCreateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ActiviteitCreateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
