public function entreprise() { return $this->belongsTo(Entreprise::class); }
public function candidatures() { return $this->hasMany(Candidature::class); }
