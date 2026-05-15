import { Component, OnInit, PLATFORM_ID, inject } from '@angular/core';
import { isPlatformBrowser, CommonModule } from '@angular/common';
import { RouterLink, Router } from '@angular/router';
import { Navbar } from '../../core/components/navbar/navbar';

@Component({
  selector: 'app-profil',
  standalone: true,
  imports: [RouterLink, CommonModule, Navbar],
  templateUrl: './profil.html',
  styleUrl: './profil.scss'
})
export class Profil implements OnInit {
  user: any = {};

  private platformId = inject(PLATFORM_ID);
  constructor(private router: Router) {}

  ngOnInit(): void {
    if (!isPlatformBrowser(this.platformId)) return;
    const token = localStorage.getItem('token');
    if (!token) { this.router.navigate(['/login']); return; }

    fetch('http://localhost:8000/api/user', {
      headers: { 'Authorization': `Bearer ${token}` }
    }).then(r => r.json()).then(d => this.user = d);
  }

  logout() {
    if (!isPlatformBrowser(this.platformId)) return;
    const token = localStorage.getItem('token');
    fetch('http://localhost:8000/api/logout', {
      method: 'POST', headers: { 'Authorization': `Bearer ${token}` }
    }).finally(() => {
      localStorage.removeItem('token');
      this.router.navigate(['/login']);
    });
  }
}