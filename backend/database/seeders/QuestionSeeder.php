<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quizzes')->truncate();
        DB::table('questions')->truncate();
        DB::table('answers')->truncate();

        $lessons = DB::table('lessons')->limit(2)->get();

        foreach ($lessons as $lesson) {

            // ===== QUIZ =====
            $quizId = DB::table('quizzes')->insertGetId([
                'title' => 'Kiểm tra: ' . $lesson->title,
                'course_id' => null,
                'lesson_id' => $lesson->id,
                'time_limit' => 20,
                'total_score' => 100,
                'pass_score' => 70,
                'max_times' => 3,
                'shuffle_questions' => true,
                'is_active' => 1,
            ]);

            // ===== QUESTIONS DATA THẬT =====
            $questions = [
                [
                    'content' => 'Vue.js là gì?',
                    'answers' => [
                        ['content' => 'Một framework frontend JavaScript', 'is_correct' => 1],
                        ['content' => 'Một database', 'is_correct' => 0],
                        ['content' => 'Một hệ điều hành', 'is_correct' => 0],
                        ['content' => 'Một backend framework', 'is_correct' => 0],
                    ]
                ],
                [
                    'content' => 'Directive nào dùng để bind dữ liệu trong Vue?',
                    'answers' => [
                        ['content' => 'v-model', 'is_correct' => 1],
                        ['content' => 'v-if', 'is_correct' => 0],
                        ['content' => 'v-for', 'is_correct' => 0],
                        ['content' => 'v-bind', 'is_correct' => 0],
                    ]
                ],
                [
                    'content' => 'HTTP method nào dùng để lấy dữ liệu?',
                    'answers' => [
                        ['content' => 'GET', 'is_correct' => 1],
                        ['content' => 'POST', 'is_correct' => 0],
                        ['content' => 'PUT', 'is_correct' => 0],
                        ['content' => 'DELETE', 'is_correct' => 0],
                    ]
                ],
                [
                    'content' => 'Laravel sử dụng ngôn ngữ gì?',
                    'answers' => [
                        ['content' => 'PHP', 'is_correct' => 1],
                        ['content' => 'Java', 'is_correct' => 0],
                        ['content' => 'Python', 'is_correct' => 0],
                        ['content' => 'C#', 'is_correct' => 0],
                    ]
                ],
                [
                    'content' => 'Token auth trong API thường đặt ở đâu?',
                    'answers' => [
                        ['content' => 'Authorization header', 'is_correct' => 1],
                        ['content' => 'HTML body', 'is_correct' => 0],
                        ['content' => 'CSS file', 'is_correct' => 0],
                        ['content' => 'Database config', 'is_correct' => 0],
                    ]
                ]
            ];

            // ===== INSERT QUESTIONS =====
            foreach ($questions as $q) {

                $questionId = DB::table('questions')->insertGetId([
                    'quiz_id' => $quizId,
                    'content' => $q['content'],
                    'type' => Question::TYPE_MULTIPLE_CHOICE
                ]);

                foreach ($q['answers'] as $a) {
                    DB::table('answers')->insert([
                        'question_id' => $questionId,
                        'content' => $a['content'],
                        'is_correct' => $a['is_correct']
                    ]);
                }
            }
        }
    }
}
