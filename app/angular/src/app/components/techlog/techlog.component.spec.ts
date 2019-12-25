import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TechlogComponent } from './techlog.component';

describe('TechlogComponent', () => {
  let component: TechlogComponent;
  let fixture: ComponentFixture<TechlogComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TechlogComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TechlogComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
