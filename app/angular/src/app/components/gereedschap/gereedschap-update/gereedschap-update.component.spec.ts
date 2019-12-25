import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GereedschapUpdateComponent } from './gereedschap-update.component';

describe('GereedschapUpdateComponent', () => {
  let component: GereedschapUpdateComponent;
  let fixture: ComponentFixture<GereedschapUpdateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GereedschapUpdateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GereedschapUpdateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
