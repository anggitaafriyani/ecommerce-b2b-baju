<use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with(['variants', 'priceTiers'])->get();
    }

    public function store(Request $request)
    {
        return Product::create($request->all());
    }

    public function show($id)
    {
        return Product::with(['variants', 'priceTiers'])->findOrFail($id);
    }
}