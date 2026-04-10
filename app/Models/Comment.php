class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'content',
        'user_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}