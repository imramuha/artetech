import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GereedschapCreateComponent } from './gereedschap-create.component';

describe('GereedschapCreateComponent', () => {
  let component: GereedschapCreateComponent;
  let fixture: ComponentFixture<GereedschapCreateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GereedschapCreateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GereedschapCreateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
