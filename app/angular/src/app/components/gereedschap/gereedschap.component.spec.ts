import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GereedschapComponent } from './gereedschap.component';

describe('GereedschapComponent', () => {
  let component: GereedschapComponent;
  let fixture: ComponentFixture<GereedschapComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GereedschapComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GereedschapComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
