import { Component, OnInit, PLATFORM_ID, inject, ChangeDetectorRef } from '@angular/core';
import { isPlatformBrowser, CommonModule } from '@angular/common';
import { Router } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { Navbar } from '../../core/components/navbar/navbar';

@Component({
  selector: 'app-entreprise',
  standalone: true,
  imports: [CommonModule, FormsModule, Navbar],
  templateUrl: './entreprise.html',
  styleUrl: './entreprise.scss'
})
export class Entreprise implements OnInit {
  offres: any[] = [];
  success = '';
  error = '';
  offre = { titre:'', description:'', domaine:'', localisation:'', duree_mois:3, date_expiration:'' };

  private platformId = inject(PLATFORM_ID);
  private cdr = inject(ChangeDetectorRef);
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
    .then(r => r.json())
    .then(d => {
      this.offres = d.data || d;
      this.cdr.detectChanges();
    });
  }

  creerOffre() {
    const token = localStorage.getItem('token');
    fetch('http://localhost:8000/api/offres', {
      method: 'POST',
      headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' },
      body: JSON.stringify({ ...this.offre, entreprise_id:1, date_publication: new Date().toISOString().split('T')[0] })
    })
    .then(r => r.json())
    .then(() => {
      this.success = 'Offre publiée !'; this.error = '';
      this.offre = { titre:'', description:'', domaine:'', localisation:'', duree_mois:3, date_expiration:'' };
      this.chargerOffres();
    })
    .catch(() => { this.error = 'Erreur lors de la création'; this.cdr.detectChanges(); });
  }

  supprimerOffre(id: number) {
    const token = localStorage.getItem('token');
    fetch(`http://localhost:8000/api/offres/${id}`, {
      method: 'DELETE', headers: { 'Authorization': `Bearer ${token}` }
    }).then(() => this.chargerOffres());
  }
}