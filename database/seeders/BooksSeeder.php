<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create or update the superadmin user
        DB::table('books')->insert([
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'isbn' => '9780743273565', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => '1984', 'author' => 'George Orwell', 'isbn' => '9780451524935', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'isbn' => '9780061120084', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Moby Dick', 'author' => 'Herman Melville', 'isbn' => '9780142437247', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'isbn' => '9780141439518', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Brave New World', 'author' => 'Aldous Huxley', 'isbn' => '9780060850524', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Catcher in the Rye', 'author' => 'J.D. Salinger', 'isbn' => '9780316769488', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Animal Farm', 'author' => 'George Orwell', 'isbn' => '9780451526342', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Jane Eyre', 'author' => 'Charlotte Brontë', 'isbn' => '9780141441146', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Wuthering Heights', 'author' => 'Emily Brontë', 'isbn' => '9780141439556', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Crime and Punishment', 'author' => 'Fyodor Dostoevsky', 'isbn' => '9780143058144', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Hobbit', 'author' => 'J.R.R. Tolkien', 'isbn' => '9780547928227', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Lord of the Flies', 'author' => 'William Golding', 'isbn' => '9780399501487', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Frankenstein', 'author' => 'Mary Shelley', 'isbn' => '9780141439471', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Odyssey', 'author' => 'Homer', 'isbn' => '9780140268867', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Iliad', 'author' => 'Homer', 'isbn' => '9780140275360', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'War and Peace', 'author' => 'Leo Tolstoy', 'isbn' => '9780199232765', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Great Expectations', 'author' => 'Charles Dickens', 'isbn' => '9780141439563', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Brothers Karamazov', 'author' => 'Fyodor Dostoevsky', 'isbn' => '9780374528379', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Don Quixote', 'author' => 'Miguel de Cervantes', 'isbn' => '9780060934347', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Les Misérables', 'author' => 'Victor Hugo', 'isbn' => '9780451419439', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Fahrenheit 451', 'author' => 'Ray Bradbury', 'isbn' => '9781451673319', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Dracula', 'author' => 'Bram Stoker', 'isbn' => '9780486411095', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'A Tale of Two Cities', 'author' => 'Charles Dickens', 'isbn' => '9780486406510', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Scarlet Letter', 'author' => 'Nathaniel Hawthorne', 'isbn' => '9780486280486', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Picture of Dorian Gray', 'author' => 'Oscar Wilde', 'isbn' => '9780141439570', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Metamorphosis', 'author' => 'Franz Kafka', 'isbn' => '9780553213690', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Stranger', 'author' => 'Albert Camus', 'isbn' => '9780679720201', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Heart of Darkness', 'author' => 'Joseph Conrad', 'isbn' => '9780141441672', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Catch-22', 'author' => 'Joseph Heller', 'isbn' => '9781451626650', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
