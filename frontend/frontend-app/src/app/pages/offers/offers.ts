import { Component, OnInit, PLATFORM_ID, inject, ChangeDetectorRef } from '@angular/core';
import { isPlatformBrowser, CommonModule } from '@angular/common';
import { RouterLink, Router } from '@angular/router';
import { Navbar } from '../../core/components/navbar/navbar';

@Component({
  selector: 'app-offers',
  standalone: true,
  imports: [RouterLink, CommonModule, Navbar],
  templateUrl: './offers.html',
  styleUrl: './offers.scss'
})
export class Offers implements OnInit {
  offers: any[] = [];
  error = '';

  private platformId = inject(PLATFORM_ID);
  private cdr = inject(ChangeDetectorRef);
  constructor(private router: Router) {}

  ngOnInit(): void {
    if (!isPlatformBrowser(this.platformId)) return;
    const token = localStorage.getItem('token');
    if (!token) { this.router.navigate(['/login']); return; }

    fetch('http://localhost:8000/api/offres', {
      headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' }
    })
    .then(r => r.json())
    .then(d => {
      this.offers = d.data || d;
      this.cdr.detectChanges();
    })
    .catch(() => {
      this.error = 'Impossible de charger les offres';
      this.cdr.detectChanges();
    });
  }

  postuler(offreId: number) {
    const token = localStorage.getItem('token');
    fetch('http://localhost:8000/api/candidatures', {
      method: 'POST',
      headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' },
      body: JSON.stringify({ offre_id: offreId })
    })
    .then(() => alert('Candidature envoyée !'))
    .catch(() => alert('Erreur lors de la candidature'));
  }
}