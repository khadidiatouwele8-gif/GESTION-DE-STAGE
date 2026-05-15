import { Component, OnInit, PLATFORM_ID, inject, ChangeDetectorRef } from '@angular/core';
import { isPlatformBrowser, CommonModule } from '@angular/common';
import { RouterLink, Router } from '@angular/router';
import { Navbar } from '../../core/components/navbar/navbar';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [RouterLink, CommonModule, Navbar],
  templateUrl: './dashboard.html',
  styleUrl: './dashboard.scss'
})
export class Dashboard implements OnInit {
  userName = '';
  nbOffres = 0;
  nbCandidatures = 0;
  nbStages = 0;

  private platformId = inject(PLATFORM_ID);
  private cdr = inject(ChangeDetectorRef);
  constructor(private router: Router) {}

  ngOnInit(): void {
    if (!isPlatformBrowser(this.platformId)) return;
    const token = localStorage.getItem('token');
    if (!token) { this.router.navigate(['/login']); return; }

    fetch('http://localhost:8000/api/user', {
      headers: { 'Authorization': `Bearer ${token}` }
    })
    .then(r => r.json())
    .then(d => {
      this.userName = d.name || 'Utilisateur';
      this.cdr.detectChanges();
    });

    fetch('http://localhost:8000/api/offres', {
      headers: { 'Authorization': `Bearer ${token}` }
    })
    .then(r => r.json())
    .then(d => {
      this.nbOffres = (d.data || d).length;
      this.cdr.detectChanges();
    });

    fetch('http://localhost:8000/api/candidatures', {
      headers: { 'Authorization': `Bearer ${token}` }
    })
    .then(r => r.json())
    .then(d => {
      this.nbCandidatures = (d.data || d).length;
      this.cdr.detectChanges();
    })
    .catch(() => {});
  }

  logout() {
    if (!isPlatformBrowser(this.platformId)) return;
    const token = localStorage.getItem('token');
    fetch('http://localhost:8000/api/logout', {
      method: 'POST',
      headers: { 'Authorization': `Bearer ${token}` }
    }).finally(() => {
      localStorage.removeItem('token');
      this.router.navigate(['/login']);
    });
  }
}