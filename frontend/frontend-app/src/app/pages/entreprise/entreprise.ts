import { Component, OnInit, PLATFORM_ID, inject } from '@angular/core';
import { isPlatformBrowser } from '@angular/common';
import { RouterLink, Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-entreprise',
  standalone: true,
  imports: [RouterLink, CommonModule, FormsModule],
  templateUrl: './entreprise.html',
  styleUrl: './entreprise.scss'
})
export class Entreprise implements OnInit {
  offres: any[] = [];
  success = '';
  error = '';
  offre = {
    titre: '', description: '', domaine: '',
    localisation: '', duree_mois: 3, date_expiration: ''
  };

  private platformId = inject(PLATFORM_ID);
  constructor(private router: Router) {}

  ngOnInit(): void {
    if (!isPlatformBrowser(this.platformId)) return;
    const token = localStorage.getItem('token');
    if (!token) { this.router.navigate(['/login']); return; }
    this.chargerOffres();
  }

  chargerOffres() {
    const token = localStorage.getItem('token');
    fetch('http://localhost:8000/api/offres', {
      headers: { 'Authorization': `Bearer ${token}` }
    })
    .then(res => res.json())
    .then(data => this.offres = data.data || data);
  }

  creerOffre() {
    const token = localStorage.getItem('token');
    fetch('http://localhost:8000/api/offres', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        ...this.offre,
        entreprise_id: 1,
        date_publication: new Date().toISOString().split('T')[0]
      })
    })
    .then(res => res.json())
    .then(() => {
      this.success = 'Offre publiée avec succès !';
      this.error = '';
      this.chargerOffres();
      this.offre = { titre:'', description:'', domaine:'', localisation:'', duree_mois:3, date_expiration:'' };
    })
    .catch(() => this.error = 'Erreur lors de la création');
  }

  supprimerOffre(id: number) {
    const token = localStorage.getItem('token');
    fetch(`http://localhost:8000/api/offres/${id}`, {
      method: 'DELETE',
      headers: { 'Authorization': `Bearer ${token}` }
    })
    .then(() => this.chargerOffres());
  }
}