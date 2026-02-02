import { Head, usePage } from "@inertiajs/react"
import axios from "axios"
import { useEffect, useState } from "react"
import { Button } from "@/components/ui/button"
import { Card, CardContent } from "@/components/ui/card"
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/app-layout';
import { home } from '@/routes';
import { show } from '@/routes/articles';
import type { BreadcrumbItem } from '@/types';

export default function ArticleShow() {
    const id = window.location.pathname.split("/").pop()
    const { auth } = usePage().props
    const user = auth?.user

    const [article, setArticle] = useState(null)
    const [comments, setComments] = useState([])
    const [meta, setMeta] = useState(null)
    const [page, setPage] = useState(1)
    const [comment, setComment] = useState("")

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Список статей',
            href: home().url,
        },
        {
            title: 'Статья номер - ' + id,
            href: show(id).url,
        },
    ];

    const formatDate = (date) => {
        return new Date(date).toLocaleDateString("ru-RU", {
            day: "2-digit",
            month: "long",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit",
        })
    }

    useEffect(() => {
        axios.get(`/api/articles/${id}`).then(res => {
            setArticle(res.data.data)
        })
    }, [id])

    useEffect(() => {
        axios
            .get(`/api/comments`, { params: {page: page, article: id}})
            .then(res => {
                setComments(res.data.data)
                setMeta(res.data.meta)
            })
    }, [id, page])

    const submitComment = () => {
        axios
            .post(`/api/comments`, {
                article_id: id,
                author_name: user.name,
                content: comment,
            })
            .then((res) => {
                setComments((prev) => [
                    res.data.data,
                    ...prev,
                ]);
                setComment('');
            });
    }

    if (!article) return null

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={article.title} />
            <div className="mx-auto max-w-4xl space-y-6 p-6">
                <h1 className="text-3xl font-bold text-white">
                    {article.title}
                </h1>

                <div className="whitespace-pre-line text-zinc-300">
                    {article.content}
                </div>

                <hr className="border-zinc-700" />

                <h2 className="text-xl font-semibold text-white">
                    Комментарии
                </h2>

                {user && (
                    <Card className="bg-zinc-900">
                        <CardContent className="space-y-3">
                            <Textarea
                                value={comment}
                                onChange={(e) => setComment(e.target.value)}
                                placeholder="Ваш комментарий..."
                            />
                            <Button onClick={submitComment} disabled={!comment}>
                                Отправить
                            </Button>
                        </CardContent>
                    </Card>
                )}

                <div className="space-y-3">
                    {comments.map((c) => (
                        <Card key={c.id} className="bg-zinc-900">
                            <CardContent className="space-y-2">
                                <div className="flex justify-between text-sm text-zinc-400">
                                    <span>
                                        {c.author_name ??
                                            'Удалённый пользователь'}
                                    </span>
                                    <span>{formatDate(c.created_at)}</span>
                                </div>

                                <p className="whitespace-pre-line text-zinc-200">
                                    {c.content}
                                </p>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {meta && (
                    <div className="flex justify-center gap-2">
                        <Button
                            variant="outline"
                            disabled={page === 1}
                            onClick={() => setPage((p) => p - 1)}
                        >
                            Назад
                        </Button>

                        <Button
                            variant="outline"
                            disabled={page === meta.last_page}
                            onClick={() => setPage((p) => p + 1)}
                        >
                            Вперёд
                        </Button>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}
