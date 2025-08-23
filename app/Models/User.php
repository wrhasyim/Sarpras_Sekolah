// ... (namespace, use statements)

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'kelas_id',
    ];
    // ... (hidden, casts)

    // Relasi ke Kelas (untuk Wali Kelas)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}