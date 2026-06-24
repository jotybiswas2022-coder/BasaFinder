<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('faqs')->insert([
            [
                'question' => 'How do I search for properties on BasaFinder?',
                'answer' => 'Simply use the search bar on our homepage or browse through categories. You can filter by location, property type, rent range, bedrooms, and more to find exactly what you\'re looking for.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Is BasaFinder free to use?',
                'answer' => 'Yes! Browsing and searching for properties is completely free. Posting a property is also free for basic listings. We offer premium features for enhanced visibility at affordable rates.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'How are properties verified?',
                'answer' => 'We verify each property through a multi-step process including owner identity verification, property documentation checks, and periodic quality reviews to ensure authenticity.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Can I post a property for rent?',
                'answer' => 'Absolutely! Click on "Post Property" in the navigation menu, fill in the details about your property, add photos, and submit. Your listing will go live after our verification process.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'How do I contact a property owner?',
                'answer' => 'On each property detail page, you\'ll find a "Contact Owner" button. You can send a direct message, call, or WhatsApp the owner through the provided contact information.',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
