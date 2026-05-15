import { Component, PLATFORM_ID, inject } from '@angular/core';
import { isPlatformBrowser } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { RouterLink, Router } from '@angular/router';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [FormsModule, RouterLink, CommonModule],
  templateUrl: './register.html',
  styleUrl: './register.scss'
})
export class Register {
  name = '';
  email = '';
  password = '';
  password_confirmation = '';
  error = '';
  success = '';

  private platformId = inject(PLATFORM_ID);
  constructor(private router: Router) {}

  submit() {
    if (!isPlatformBrowser(this.platformId)) return;

    fetch('http://localhost:8000/api/register', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
        role_id: 5
      })
    })
    .then(res => res.json())
    .then(data => {
      if (data.token) {
        localStorage.setItem('token', data.token);
        this.router.navigate(['/dashboard']);
      } else {
        this.error = data.message || 'Erreur lors de l\'inscription';
      }
    })
    .catch(() => this.error = 'Erreur de connexion');
  }
}