<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Contact",
 *     title="Contact",
 *     description="Contact model",
 *     @OA\Property(property="id", type="integer", format="int64", description="Contact ID"),
 *     @OA\Property(property="name", type="string", description="Contact name"),
 *     @OA\Property(property="email", type="string", format="email", description="Contact email"),
 *     @OA\Property(property="phone", type="string", description="Contact phone"),
 *     @OA\Property(property="mobile", type="string", description="Contact mobile"),
 *     @OA\Property(property="street", type="string", description="Contact street"),
 *     @OA\Property(property="city", type="string", description="Contact city"),
 *     @OA\Property(property="state", type="string", description="Contact state"),
 *     @OA\Property(property="zip", type="string", description="Contact zip"),
 *     @OA\Property(property="country", type="string", description="Contact country"),
 *     @OA\Property(property="vat", type="string", description="Contact VAT"),
 * )
 *
 * @OA\Schema(
 *     schema="ContactRequest",
 *     title="ContactRequest",
 *     description="Contact request model",
 *     @OA\Property(property="name", type="string", description="Contact name"),
 *     @OA\Property(property="email", type="string", format="email", description="Contact email"),
 *     @OA\Property(property="phone", type="string", description="Contact phone"),
 *     @OA\Property(property="mobile", type="string", description="Contact mobile"),
 *     @OA\Property(property="street", type="string", description="Contact street"),
 *     @OA\Property(property="city", type="string", description="Contact city"),
 *     @OA\Property(property="state", type="string", description="Contact state"),
 *     @OA\Property(property="zip", type="string", description="Contact zip"),
 *     @OA\Property(property="country", type="string", description="Contact country"),
 *     @OA\Property(property="vat", type="string", description="Contact VAT"),
 * )
 */
class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'mobile', 'street', 'city', 'state', 'zip', 'country', 'vat'];

}
