import { Component, OnInit, PLATFORM_ID, inject } from '@angular/core';
import { isPlatformBrowser } from '@angular/common';
import { RouterLink, Router } from '@angular/router';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './dashboard.html',
  styleUrl: './dashboard.scss'
})
export class Dashboard implements OnInit {
  userName = '';
  nbOffres = 0;
  nbCandidatures = 0;
  nbStages = 0;

  private platformId = inject(PLATFORM_ID);
  constructor(private router: Router) {}

  ngOnInit(): void {
    if (!isPlatformBrowser(this.platformId)) return;

    const token = localStorage.getItem('token');
    if (!token) {
      this.router.navigate(['/login']);
      return;
    }

    fetch('http://localhost:8000/api/user', {
      headers: { 'Authorization': `Bearer ${token}` }
    })
    .then(res => res.json())
    .then(data => this.userName = data.name || 'Utilisateur');

    fetch('http://localhost:8000/api/offres', {
      headers: { 'Authorization': `Bearer ${token}` }
    })
    .then(res => res.json())
    .then(data => this.nbOffres = (data.data || data).length);
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