public function candidature() { return $this->belongsTo(Candidature::class); }
public function encadreur() { return $this->belongsTo(Encadreur::class); }
public function convention() { return $this->hasOne(Convention::class); }
public function rapport() { return $this->hasOne(Rapport::class); }
