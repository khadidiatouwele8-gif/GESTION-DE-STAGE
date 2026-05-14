public function role() { return $this->belongsTo(Role::class); }
public function etudiant() { return $this->hasOne(Etudiant::class); }
public function entreprise() { return $this->hasOne(Entreprise::class); }
public function encadreur() { return $this->hasOne(Encadreur::class); }
