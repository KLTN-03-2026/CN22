<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questions')->truncate();
        DB::table('coding_questions')->truncate();
        DB::table('test_cases')->truncate();

        // ===== 1. Question (gắn với quiz) =====
        $questionId = DB::table('questions')->insertGetId([
            'quiz_id' => 1, // phải có quiz trước
            'content' => 'Viết hàm sum(a, b) trả về tổng 2 số',
            'type' => Question::TYPE_SHORT_ANSWER
        ]);

        // ===== 2. Coding Question =====
        $codingId = DB::table('coding_questions')->insertGetId([
            'question_id' => $questionId,
            'description' => 'Viết hàm sum(a, b) trả về tổng của 2 số nguyên',
            'time_limit' => 2,
            'memory_limit' => 128,
            'sample_input' => '1,2',
            'sample_output' => '3'
        ]);

        // ===== 3. Testcases =====
        $testcases = [
            ['input' => '1,2', 'expected_output' => '3', 'is_hidden' => false],
            ['input' => '5,7', 'expected_output' => '12', 'is_hidden' => false],
            ['input' => '10,20', 'expected_output' => '30', 'is_hidden' => true],
            ['input' => '100,200', 'expected_output' => '300', 'is_hidden' => true],
        ];

        foreach ($testcases as $tc) {
            DB::table('test_cases')->insert([
                'code_id' => $codingId,
                'input' => $tc['input'],
                'expected_output' => $tc['expected_output'],
                'is_hidden' => $tc['is_hidden']
            ]);
        }
    }
}
