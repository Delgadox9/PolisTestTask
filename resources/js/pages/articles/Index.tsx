import { Head, Link } from "@inertiajs/react";
import axios from 'axios';
import { useEffect, useState } from "react";
import { Button } from "@/components/ui/button";
import {
    Card,
    CardHeader,
    CardTitle,
    CardContent,
} from "@/components/ui/card"
import AppLayout from '@/layouts/app-layout';
import { home } from '@/routes';
import type { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Список статей',
        href: home().url,
    },
];

export default function ArticlesIndex() {
    const [articles, setArticles] = useState([])
    const [meta, setMeta] = useState(null)
    const [page, setPage] = useState(1)

    useEffect(() => {
        axios.get(`/api/articles`, { params: { page: page } }).then((res) => {
            setArticles(res.data.data);
            setMeta(res.data.meta);
        });
    }, [page])

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Список статей" />
            <div className="mx-auto max-w-5xl space-y-6 p-6">
                <div className="flex items-center justify-between">
                    <h1 className="text-2xl font-bold text-white">Статьи</h1>

                    <Link href="/articles/create">
                        <Button>Создать статью</Button>
                    </Link>
                </div>

                <div className="grid gap-4 md:grid-cols-2">
                    {articles.map((article) => (
                        <Link key={article.id} href={`/articles/${article.id}`}>
                            <Card className="bg-zinc-900 transition hover:bg-zinc-800">
                                <CardHeader>
                                    <CardTitle className="text-white">
                                        {article.title}
                                    </CardTitle>
                                </CardHeader>
                                <CardContent className="text-zinc-400">
                                    {article.excerpt}
                                </CardContent>
                            </Card>
                        </Link>
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
