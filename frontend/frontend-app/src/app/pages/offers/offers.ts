import { Component, OnInit, PLATFORM_ID, inject } from '@angular/core';
import { isPlatformBrowser } from '@angular/common';
import { RouterLink, Router } from '@angular/router';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-offers',
  standalone: true,
  imports: [RouterLink, CommonModule],
  templateUrl: './offers.html',
  styleUrl: './offers.scss'
})
export class Offers implements OnInit {
  offers: any[] = [];
  error = '';

  private platformId = inject(PLATFORM_ID);
  constructor(private router: Router) {}

  ngOnInit(): void {
    if (!isPlatformBrowser(this.platformId)) return;

    const token = localStorage.getItem('token');
    if (!token) {
      this.router.navigate(['/login']);
      return;
    }

    fetch('http://localhost:8000/api/offres', {
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json'
      }
    })
    .then(res => res.json())
    .then(data => this.offers = data.data || data)
    .catch(() => this.error = 'Impossible de charger les offres');
  }

  postuler(offreId: number) {
    if (!isPlatformBrowser(this.platformId)) return;
    const token = localStorage.getItem('token');
    fetch('http://localhost:8000/api/candidatures', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ offre_id: offreId })
    })
    .then(() => alert('Candidature envoyée !'))
    .catch(() => alert('Erreur lors de la candidature'));
  }
}